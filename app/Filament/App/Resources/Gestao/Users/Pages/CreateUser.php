<?php

namespace App\Filament\App\Resources\Gestao\Users\Pages;

use App\Filament\App\Resources\Gestao\Users\UserResource;
use App\Models\Person;
use App\Models\User;
use Exception;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        return DB::transaction(function () use ($data) {
            // create new person
            $new_person_id = Person::withTrashed()->latest('id')->first()->id + 1;

            $person_data = $this->data['person'];
            $person_data['id'] = $new_person_id;
            $person_data['uuid'] = Str::uuid();
            $person = Person::create($person_data);

            // create user and attach person
            $new_user_id = User::withTrashed()->latest('id')->first()->id + 1;
            $data['id'] = $new_user_id;
            $data['uuid'] = Str::uuid();
            $data['person_id'] = $person->id;
            $data['password'] = Hash::make($person->cpf_cnpj);

            $user = User::create($data);
            // Throw an exception or return false to trigger a rollback
            if (!$user) {
                throw new Exception('Erro ao criar usuário!');
            }

            return $user;
        });
    }
}
