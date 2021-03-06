<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    private $_id;
    const ERROR_EMAIL_INVALID = 3;
    const ERROR_STATUS_NOTACTIV = 4;
    const ERROR_STATUS_BAN = 5;

    /**
     * Authenticates a user.
     * The example implementation makes sure if the username and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */
    public function authenticate()
    {

        if (strpos($this->name, "@")) {
            $user = User::model()->notsafe()->findByAttributes(array('email' => $this->name));
        } else {
            //echo '!'.$this->name;
            $phone=Order::FormatPhone($this->name);
            $user = User::model()->notsafe()->findByAttributes(array('phone' => $phone));
        }
        if ($user === null)
            if (strpos($this->name, "@")) {
                $this->errorCode = self::ERROR_EMAIL_INVALID;
            } else {
                $this->errorCode = self::ERROR_USERNAME_INVALID;
            }
        // echo Yii::app()->getModule('user')->encrypting($this->password);
        // echo $user->pass;
        if (Yii::app()->getModule('user')->encrypting($this->password) != $user->pass) {
            // echo Yii::app()->getModule('user')->encrypting($this->password);
            $this->errorCode = self::ERROR_PASSWORD_INVALID;

        } else if ($user->status == 0 && Yii::app()->getModule('user')->loginNotActiv == false &&$user->email!='')
            $this->errorCode = self::ERROR_STATUS_NOTACTIV;
        else if ($user->status == -1)
            $this->errorCode = self::ERROR_STATUS_BAN;
        else {
            $this->_id = $user->id;
            $this->username = $user->name;
            $this->errorCode = self::ERROR_NONE;
        }
        return !$this->errorCode;
    }

    /**
     * @return integer the ID of the user record
     */
    public function getId()
    {
        return $this->_id;
    }
}