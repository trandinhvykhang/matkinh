<?php
    include '../utils/database.php';
    if(isset($_POST["added"])) {
        $sql = "INSERT INTO nhanvien (manv,tennv,macv,namsinh,sdt) VALUES ('{$_POST['manv']}','{$_POST['tennv']}','{$_POST['macv']}','{$_POST['namsinh']}','{$_POST['sdt']}')";
        if ($db->query($sql) === TRUE) {
            $alert = "Thêm nhân viên thành công";
            $alert_type = "success";
        }
    }

    if(isset($_POST["edited"])) {
        $sql = "UPDATE nhanvien SET tennv='{$_POST['tennv']}',macv='{$_POST['macv']}',namsinh='{$_POST['namsinh']}',sdt='{$_POST['sdt']}' WHERE manv='{$_POST['edited']}'";
        if ($db->query($sql) === TRUE) {
            $alert = "Sửa nhân viên thành công";
            $alert_type = "success";
        }
    }

    if(isset($_POST["delete"])) {
        $sql = "DELETE FROM nhanvien WHERE manv='{$_POST['delete']}'";
        if ($db->query($sql) === TRUE) {
            $alert = "Xoá nhân viên thành công";
            $alert_type = "success";
        }
    }
?>
<form class="main-box" method="POST" enctype="multipart/form-data">
    <div class="main-title">
        Danh sách nhân viên
    </div>
    <div class="search-box">
        <input class="search-input" name="search">
        <button class="search-btn" name="search-submit">
            <img class="search-icon" src="../assets/icons/search.svg">
        </button>
    </div>
    <div class="main-content">
        <div class="main-table">
            <div class="table-hd">Mã nhân viên</div>
            <div class="table-hd">Tên nhân viên</div>
            <div class="table-hd">Chức vụ</div>
            <div class="table-hd">Năm sinh</div>
            <div class="table-hd">Số điện thoại</div>
            <div class="table-hd">Thao tác</div>
            <?php
                if(isset($_POST["add"])):
            ?>
                <div class="table-i">
                    <input class="table-input" name="manv" required>
                </div>
                <div class="table-i">
                    <input class="table-input" name="tennv" required>
                </div>
                <div class="table-i">
                    <select class="table-input" name="macv" required>
                        <?php
                            $result = $db->query("SELECT * FROM chucvu");
                            if (mysqli_num_rows($result) > 0):
                                while($row = $result->fetch_assoc()):
                        ?>
                        <option value="<?=$row["macv"]?>"><?=$row["tencv"]?></option>
                        <?php endwhile; endif;?>
                    </select>
                </div>
                <div class="table-i">
                    <input class="table-input" type="date" name="namsinh" required>
                </div>
                <div class="table-i">
                    <input class="table-input" name="sdt" required>
                </div>
                <div class="table-i">
                    <button class="table-btn" name="added">Thêm</button>
                </div>
            <?php else: ?>
                <button class="table-add" name="add">
                    <img class="table-add-icon" src="../assets/icons/plus-circle.svg">
                    Thêm nhân viên
                </button>
            <?php endif; ?>
            <?php
                $search_sql = (isset($_POST["search-submit"]) && $_POST["search"] !== "") ? " AND tennv LIKE '%{$_POST['search']}%'" : "";
                $result = $db->query("SELECT n.manv, n.tennv, c.macv, c.tencv, n.namsinh, n.sdt FROM nhanvien n, chucvu c WHERE n.macv = c.macv{$search_sql}");

                if (mysqli_num_rows($result) > 0):
                    while($row = $result->fetch_assoc()):
                        if(isset($_POST["edit"]) && $_POST["edit"] == $row["manv"]):
            ?>
                <div class="table-i"><?=$row["manv"]?></div>
                <div class="table-i">
                    <input class="table-input" name="tennv" value="<?=$row["tennv"]?>" required>
                </div>
                <div class="table-i">
                    <select class="table-input" name="macv" required>
                        <?php
                            $result1 = $db->query("SELECT * FROM chucvu");
                            if (mysqli_num_rows($result1) > 0):
                                while($row1 = $result1->fetch_assoc()):
                        ?>
                        <option value="<?=$row1["macv"]?>"><?=$row1["tencv"]?></option>
                        <?php endwhile; endif;?>
                    </select>
                </div>
                <div class="table-i">
                    <input type="date" class="table-input" name="namsinh" value="<?=$row["namsinh"]?>" required>
                </div>
                <div class="table-i">
                    <input class="table-input" name="sdt" value="<?=$row["sdt"]?>" required>
                </div>
                <div class="table-i">
                    <button class="table-btn" name="edited" value=<?=$row["manv"]?>>Sửa</button>
                </div>
            <?php else: ?>
                <div class="table-i"><?=$row["manv"]?></div>
                <div class="table-i"><?=$row["tennv"]?></div>
                <div class="table-i"><?=$row["tencv"]?></div>
                <div class="table-i"><?=$row["namsinh"]?></div>
                <div class="table-i"><?=$row["sdt"]?></div>
                <div class="table-i">
                    <button class="icon-box" name="edit" value="<?=$row["manv"]?>">
                        <img src="../assets/icons/edit-2.svg" class="table-icon">
                    </button>
                    <button class="icon-box" name="delete" value="<?=$row["manv"]?>">
                        <img src="../assets/icons/trash.svg" class="table-icon">
                    </button>
                </div>
            <?php endif; endwhile; endif; ?>
        </div>
    </div>
</form>