<?php

use App\Domains\Users\Actions\CreateNewUserAction;
use App\Domains\Users\DTOs\UserDTO;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDefaultAdminUser extends Migration
{
    const USERNAME = "admin";

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /** @var CreateNewUserAction $createUserAction */
        $createUserAction = App::make(CreateNewUserAction::class);

        $createUserAction->execute(new UserDTO(
            self::USERNAME,
            "admin@admin.com",
            "admin123",
            \App\Domains\Users\Enums\UserRoleEnum::admin()
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $user = \App\Domains\Users\Models\User::where("username", self::USERNAME)->get()->first() ?? null;

        if ($user) {
            $user->delete();
        }
    }
}
