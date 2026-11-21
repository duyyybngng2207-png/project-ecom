<?php
class CoreModel
{
    private $conn;
    public function __construct()
    {
        $this->conn = Database::connectPDO();
    }

    public function getUserDetail()
    {
        //Lấy thông tin users
        $token = getSession('token_login');
        if (!empty($token)) {
            $checkTokenLogin = $this->getOne("SELECT * FROM token_login WHERE token='$token'");
            if (!empty($checkTokenLogin)) {
                $user_id = $checkTokenLogin['user_id'];
                $getUserDetail = $this->getOne("SELECT fullname,avartar FROM users WHERE id='$user_id'");

                if (!empty($getUserDetail)) {
                    return $getUserDetail;
                }
            }
        }
        return false;
    }


    // Truy vấn nhiều dòng dữ liệu 
    function getAll($sql)
    {
        $stm = $this->conn->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // Truy vấn 1 dòng dữ liệu 
    function getOne($sql)
    {
        $stm = $this->conn->prepare($sql);
        $stm->execute();
        $result = $stm->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    //Đếm số dòng trả về 
    function getRows($sql)
    {
        $stm = $this->conn->prepare($sql);
        $stm->execute();
        $rel = $stm->rowCount();
        return $rel;
    }

    //Insert dữ liệu 
    function insert($table, $data)
    {
        $keys = array_keys($data);
        $cot = implode(',', $keys);
        $place = ':' . implode(',:', $keys);

        $sql = "INSERT INTO `$table` ($cot) VALUES($place)"; //Name => Placeholder 
        // echo $sql;
        $stm = $this->conn->prepare($sql); //Sql injection 
        // Thực thi câu lệnh 
        $rel = $stm->execute($data);
        return $rel;
    }

    function insertReturnId($table, $data)
    {
        $keys = array_keys($data);
        $cot = implode(',', $keys);
        $place = ':' . implode(',:', $keys);

        $sql = "INSERT INTO `$table` ($cot) VALUES($place)"; //Name => Placeholder 
        // echo $sql;
        $stm = $this->conn->prepare($sql); //Sql injection 
        // Thực thi câu lệnh 
        $stm->execute($data);
        $lastId = $this->conn->lastInsertId();
        return $lastId;
    }

    //Update dữ liệu 
    function update($table, $data, $condition = '')
    {
        $update = '';
        foreach ($data as $key => $value) {
            $update .= $key . '=:' . $key . ',';
        }
        $update = trim($update, ',');
        if (!empty($condition)) {
            $sql = "UPDATE $table SET $update WHERE $condition";
        } else {
            $sql = "UPDATE $table SET $update";
        }

        //Chuẩn bị câu lệnh sql
        $tmp = $this->conn->prepare($sql);
        //Thực thi câu lệnh 
        $rel = $tmp->execute($data);
        return $rel;
    }
    //Hàm xóa dữ liệu 
    function delete($table, $condition = '')
    {
        if (!empty($condition)) {
            $sql = "DELETE FROM $table WHERE $condition";
        } else {
            $sql = "DELETE FROM $table";
        }

        $stm = $this->conn->prepare($sql);
        $rel = $stm->execute();
        return $rel;
    }

    //Hàm lấy ID dữ liệu mới Insert
    function lastID()
    {
        return $this->conn->lastInsertId();
    }

    // // Truy vấn tùy chỉnh (dùng cho UPDATE đặc biệt như +1)
    function query($sql, $params = [])
    {
        $stm = $this->conn->prepare($sql);
        $rel = $stm->execute($params);
        return $rel;
    }
}
