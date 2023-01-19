<?php

namespace console\controllers;

use common\models\User;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\console\Exception;

class UserController extends Controller
{
    /**
     * Register user from console.
     *
     * @return string
     */
    public function actionCreate($email = 'test@test.ru', $password = 'test1')
    {
        $user = new User();
        $user->email = $email;
        $user->generateAuthKey();
        $user->status = User::STATUS_ACTIVE;
        $user->password = $password;
        $user->generatePasswordResetToken();
        $user->generateEmailVerificationToken();
        $user->created_at = time();
        $user->updated_at = time();

        if(!($user->validate() && $user->save())){
            throw new Exception("User $user->email NOT created! Save model error...");
        }

        echo "User " . $user->email . "- created" . PHP_EOL;

        return ExitCode::OK;
    }

    /**
     * Set new pass from console.
     *
     * @return string
     */
    public function actionResetUserPassword($email)
    {
        $user = User::findByEmail($email);

        if (empty($user)) {
            throw new Exception("User not found.");
        }

        $newPass = readline("Enter new password: ");

        $user->password = $newPass;
        $user->generatePasswordResetToken();

        if(!($user->validate() && $user->save())){
            throw new Exception("User $user->email NOT change password! Save model error...");
        }

        echo "User " . $user->email . "- saved" . PHP_EOL;

        return ExitCode::OK;
    }
}
