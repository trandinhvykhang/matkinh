<?php
    include '../utils/database.php';
    if(isset($_POST["added"])) {
        $sql = "INSERT INTO chucvu (macv, tencv) VALUES ('{$_POST['macv']}','{$_POST['tencv']}')";
        if ($db->query($sql) === TRUE) {
            $alert = "Thêm chức vụ thành công";
            $alert_type = "success";
        }
    }

    if(isset($_POST["edited"])) {
        $sql = "UPDATE chucvu SET tencv='{$_POST['tencv']}' WHERE macv='{$_POST['edited']}'";
        if ($db->query($sql) === TRUE) {
            $alert = "Sửa chức vụ thành công";
            $alert_type = "success";
        }
    }

    if(isset($_POST["delete"])) {
        $sql = "DELETE FROM chucvu WHERE macv='{$_POST['delete']}'";
        if ($db->query($sql) === TRUE) {
            $alert = "Xoá chức vụ thành công";
            $alert_type = "success";
        }
    }
?>
<form class="main-box" method="POST" enctype="multipart/form-data">
    <div class="main-title">
        Danh sách chức vụ
    </div>
    <div class="main-content">
        <div class="main-table">
            <div class="table-hd">Mã chức vụ</div>
            <div class="table-hd">Tên chức vụ</div>
            <div class="table-hd">Thao tác</div>
            <?php
                if(isset($_POST["add"])):
            ?>
                <div class="table-i">
                    <input class="table-input" name="macv" required>
                </div>
                <div class="table-i">
                    <input class="table-input" name="tencv" required>
                </div>
                <div class="table-i">
                    <button class="table-btn" name="added">Thêm</button>
                </div>
            <?php else: ?>
                <button class="table-add" name="add">
                    <img class="table-add-icon" src="../assets/icons/plus-circle.svg">
                    Thêm chức vụ
                </button>
            <?php endif; ?>
            <?php
                $result = $db->query("SELECT * FROM chucvu");

                if (mysqli_num_rows($result) > 0):
                    while($row = $result->fetch_assoc()):
                        if(isset($_POST["edit"]) && $_POST["edit"] == $row["macv"]):
            ?>
                <div class="table-i"><?=$row["macv"]?></div>
                <div class="table-i">
                    <input class="table-input" name="tencv" value="<?=$row["tencv"]?>" required>
                </div>
                <div class="table-i">
                    <button class="table-btn" name="edited" value=<?=$row["macv"]?>>Sửa</button>
                </div>
            <?php else: ?>
                <div class="table-i"><?=$row["macv"]?></div>
                <div class="table-i"><?=$row["tencv"]?></div>
                <div class="table-i">
                    <button class="icon-box" name="edit" value="<?=$row["macv"]?>">
                        <img src="../assets/icons/edit-2.svg" class="table-icon">
                    </button>
                    <button class="icon-box" name="delete" value="<?=$row["macv"]?>">
                        <img src="../assets/icons/trash.svg" class="table-icon">
                    </button>
                </div>
            <?php endif; endwhile; endif; ?>
        </div>
    </div>
</form>