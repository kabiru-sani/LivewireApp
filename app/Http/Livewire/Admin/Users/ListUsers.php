<?php

namespace App\Http\Livewire\Admin\Users;

use App\Http\Livewire\Admin\AdminComponent;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;


class ListUsers extends AdminComponent
{
    use WithFileUploads;

    public $state = [];

    public $user;

    public $userIdRemoved = null;

    public $showEditModal = false;

    public $searchTerm = null;

    public $photo;

    public function changeRole(User $user, $role)
    {
        // To prevent changing roles through browser inspect code
        Validator::make(['role' => $role], [
            'role' => [
                'required',
                Rule::in(User::ROLE_ADMIN, User::ROLE_USER)
            ],
            // 'role' => 'required|in:admin,user',
        ])->validate();

        $user->update(['role' => $role]);
        $this->dispatchBrowserEvent('updated', ['message' => "Role changed to {$role} successfully."]);
    }


    public function addNewUser()
    {
        $this->reset(); //to clear the modal form data of the last edited user on creating new user

        $this->showEditModal = false;

        $this->dispatchBrowserEvent('show-form');
    }

    public function createUser()
    {
        $validatedData = Validator::make($this->state, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ])->validate();

         $validatedData['password'] = bcrypt($validatedData['password']);

         //user profile image validation and upload
         if($this->photo)
         {
            $validatedData['avatar'] = $this->photo->store('/', 'avatars');
         }

        User::create($validatedData);

        $this->dispatchBrowserEvent('hide-form', ['message' => 'User added successfully']);

    }

    public function edit(User $user)
    {
        $this->reset();

        $this->showEditModal = true;

        $this->user = $user;

        $this->state = $user->toArray(); //fetch user specific data to display on the modal form for edit

        $this->dispatchBrowserEvent('show-form');
    }

    public function updateUser()
    {
        $validatedData = Validator::make($this->state, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$this->user->id,
            'password' => 'sometimes|confirmed',
        ])->validate();

         if(!empty ($validatedData['password'])){
            $validatedData['password'] = bcrypt($validatedData['password']);
         }

         if($this->photo)
         {
            Storage::disk('avatars')->delete($this->user->avatar); // deletes the previous avatar when edited
            $validatedData['avatar'] = $this->photo->store('/', 'avatars');
         }

        $this->user->update($validatedData);

        $this->dispatchBrowserEvent('hide-form', ['message' => 'User updated successfully']);

    }

    public function confirmUserRemoval($userId)
    {
        $this->userIdRemoved = $userId;

        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function deleteUser()
    {
        $user = User::findOrFail($this->userIdRemoved);

        $user->delete();

        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'User Deleted Successfully!']);
    }

    public function render()
    {
        $users = User::query()
            ->where('name', 'like', '%'.$this->searchTerm.'%')
            ->orWhere('email', 'like', '%'.$this->searchTerm.'%')
            ->latest()->paginate(5);
        return view('livewire.admin.users.list-users',['users'=>$users]);
    }
}
