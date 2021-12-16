<?php
    namespace DAO;

    use Models\Users as Users;

    interface IUserDAO
    {
        function Add(Users $user);
        function GetAll();
    }
?>