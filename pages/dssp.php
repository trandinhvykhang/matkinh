<?php
    include '../utils/database.php';
    if(isset($_POST["added"])) {
        if (isset($_FILES["img"])) {
            $file_name = $_FILES['img']['name'];
            $file_tmp =$_FILES['img']['tmp_name'];
            move_uploaded_file($file_tmp,"../database/{$_POST['mamk']}.png");

            $sql = "INSERT INTO matkinh (mamk,tenmk,thuonghieu,mau,nsx,gia,soluong) VALUES ('{$_POST['mamk']}','{$_POST['tenmk']}','{$_POST['thuonghieu']}','{$_POST['mau']}','{$_POST['nsx']}',{$_POST['gia']},{$_POST['soluong']})";
            if ($db->query($sql) === TRUE) {
                $alert = "Thêm sản phẩm thành công";
                $alert_type = "success";
            }
        }
    }

    if(isset($_POST["edited"])) {
        $sql = "UPDATE matkinh SET tenmk='{$_POST['tenmk']}',thuonghieu='{$_POST['thuonghieu']}',mau='{$_POST['mau']}',nsx='{$_POST['nsx']}',gia={$_POST['gia']},soluong={$_POST['soluong']} WHERE mamk='{$_POST['edited']}'";
        if ($db->query($sql) === TRUE) {
            $alert = "Sửa sản phẩm thành công";
            $alert_type = "success";
        }
    }

    if(isset($_POST["delete"])) {
        unlink("../database/{$_POST['delete']}.png");
        $sql = "DELETE FROM matkinh WHERE mamk='{$_POST["delete"]}'";
        if ($db->query($sql) === TRUE) {
            $alert = "Xoá sản phẩm thành công";
            $alert_type = "success";
        }
    }
?>
<form class="main-box" method="POST" enctype="multipart/form-data">
    <div class="main-title">
        Danh sách sản phẩm
    </div>
    <div class="search-box">
        <input class="search-input" name="search">
        <button class="search-btn" name="search-submit">
            <img class="search-icon" src="../assets/icons/search.svg">
        </button>
    </div>
    <div class="main-content">
        <div class="main-table">
            <div class="table-hd">Ảnh</div>
            <div class="table-hd">Mã mắt kính</div>
            <div class="table-hd">Tên mắt kính</div>
            <div class="table-hd">Thương hiệu</div>
            <div class="table-hd">Màu</div>
            <div class="table-hd">NSX</div>
            <div class="table-hd">Giá</div>
            <div class="table-hd">SL</div>
            <div class="table-hd">Thao tác</div>
            <?php
                if(isset($_POST["add"])):
            ?>
                <div class="table-i">
                    <input name="img" type="file" id="img" style="display:none;" accept="image/*" required>
                    <label for="img" class="table-btn">Chọn ảnh</label>
                </div>
                <div class="table-i">
                    <input class="table-input" name="mamk" required>
                </div>
                <div class="table-i">
                    <input class="table-input" name="tenmk" required>
                </div>
                <div class="table-i">
                    <input class="table-input" name="thuonghieu" required>
                </div>
                <div class="table-i">
                    <input class="table-input" name="mau" required>
                </div>
                <div class="table-i">
                    <input class="table-input" name="nsx" required>
                </div>
                <div class="table-i">
                    <input class="table-input" name="gia" required>
                </div>
                <div class="table-i">
                    <input class="table-input" name="soluong" required>
                </div>
                <div class="table-i">
                    <button class="table-btn" name="added">Thêm</button>
                </div>
            <?php else: ?>
                <button class="table-add" name="add">
                    <img class="table-add-icon" src="../assets/icons/plus-circle.svg">
                    Thêm sản phẩm
                </button>
            <?php endif ?>
            <?php
                $search_sql = (isset($_POST["search-submit"]) && $_POST["search"] !== "") ? " WHERE tenmk LIKE '%{$_POST['search']}%'" : "";
                $result = $db->query("SELECT * FROM matkinh{$search_sql}");

                if (mysqli_num_rows($result) > 0):
                    while($row = $result->fetch_assoc()):
                        if(isset($_POST["edit"]) && $_POST["edit"] == $row["mamk"]):
            ?>
                <div class="table-i">
                    <img class="table-img" src="../database/<?=$row["mamk"]?>.png">
                </div>
                <div class="table-i"><?=$row["mamk"]?></div>
                <div class="table-i">
                    <input class="table-input" name="tenmk" value="<?=$row["tenmk"]?>" required>
                </div>
                <div class="table-i">
                    <input class="table-input" name="thuonghieu" value="<?=$row["thuonghieu"]?>" required>
                </div>
                <div class="table-i">
                    <input class="table-input" name="mau" value="<?=$row["mau"]?>" required>
                </div>
                <div class="table-i">
                    <input class="table-input" name="nsx" value="<?=$row["nsx"]?>" required>
                </div>
                <div class="table-i">
                    <input class="table-input" name="gia" value="<?=$row["gia"]?>" required>
                </div>
                <div class="table-i">
                    <input class="table-input" name="soluong" value="<?=$row["soluong"]?>" required>
                </div>
                <div class="table-i">
                    <button class="table-btn" name="edited" value=<?=$row["mamk"]?>>Sửa</button>
                </div>
            <?php else: ?>
                <div class="table-i">
                    <img class="table-img" src="../database/<?=$row["mamk"]?>.png">
                </div>
                <div class="table-i"><?=$row["mamk"]?></div>
                <div class="table-i"><?=$row["tenmk"]?></div>
                <div class="table-i"><?=$row["thuonghieu"]?></div>
                <div class="table-i"><?=$row["mau"]?></div>
                <div class="table-i"><?=$row["nsx"]?></div>
                <div class="table-i"><?=$row["gia"]?></div>
                <div class="table-i"><?=$row["soluong"]?></div>
                <div class="table-i">
                    <button class="icon-box" name="edit" value="<?=$row["mamk"]?>">
                        <img src="../assets/icons/edit-2.svg" class="table-icon">
                    </button>
                    <button class="icon-box" name="delete" value="<?=$row["mamk"]?>">
                        <img src="../assets/icons/trash.svg" class="table-icon">
                    </button>
                </div>
            <?php endif; endwhile; endif; ?>
        </div>
    </div>
</form>