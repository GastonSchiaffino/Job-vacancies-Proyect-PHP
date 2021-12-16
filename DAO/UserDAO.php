<?php
    namespace DAO;

    use Models\Users as Users;
    use DAO\Connection as Connection;
    use FFI\Exception;

    class UserDAO implements IUserDAO
    {   
        private $userList=array();
        private $connection;
        private $tableName = "users";

        public function Add(Users $user)
        {
            $this->SaveData($user);
        }

        private function SaveData(Users $user){
            try
            {
                $query = "INSERT INTO ".$this->tableName." ( email, nameUser, pass, user_id_api, typeUser) VALUES (:email, :nameUser, :pass, :user_id_api, :typeUser);";

                $parameters["email"] = $user->getEmail();
                $parameters["nameUser"] = $user->getName();
                $parameters["pass"] = $user->getPass();
                $parameters["user_id_api"] = $user->getUser_id_api();
                $parameters["typeUser"] = $user->getUserType();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetAll()
        {
            $this->RetreiveData();

            return $this->userList;
        }

        private function RetreiveData()
        {
            try
            {
                $this->userList= array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $row)
                {                
                    $user = new Users();

                    $user->setUsersId($row["id"]);
                    $user->setEmail($row["email"]);
                    $user->setName($row["nameUser"]);
                    $user->setPass($row["pass"]);
                    $user->setUser_id_api($row["user_id_api"]);
                    $user->setUserType($row["typeUser"]);
                 
                    array_push( $this->userList, $user);
                }

            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function UserByEmail($email)
        {
            try
            {
                $user=null;

                $query = "SELECT * FROM ".$this->tableName." WHERE ".$this->tableName.".email = '".$email."'";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $row)
                {                
                    $user = new Users();

                    $user->setUsersId($row["id"]);
                    $user->setEmail($row["email"]);
                    $user->setName($row["nameUser"]);
                    $user->setPass($row["pass"]);
                    $user->setUser_id_api($row["user_id_api"]);
                    $user->setUserType($row["typeUser"]);
                }

                return $user;
                
            }    
            catch(Exception $ex)
            {
                throw $ex;
            }
        }


        public function modify($user){

            try
            {
                $query = "UPDATE ".$this->tableName." SET nameUser = '".$user->getName()."'".
                ", pass = '".$user->getPass()."'".
                ", user_id_api = '".$user->getUser_id_api()."'".
                ", typeUser ='".$user->getUserType()."'".
                " WHERE ".$this->tableName.".email = '".$user->getEmail()."'";
                
                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                return $resultSet;

            }    
            catch(Exception $ex)
            {
                throw $ex;
            }

        }

        public function delete($email)
        {
            try{

                $query = "DELETE FROM ".$this->tableName." WHERE ".$this->tableName.".email = '".$email."'";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);

            }
            catch(Exception $ex)
            {
                throw $ex;
            }
           

        }

    }
?>