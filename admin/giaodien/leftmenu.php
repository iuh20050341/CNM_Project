<div style="padding: 10px;">
    <ul class="input-select2">
        <?php
        $sql = "SELECT id, ten_danhmuc FROM danhmuc, quyendahmuc WHERE `id_danhmuc`=`id` AND `id_quyen`=" . $_SESSION['quyen'];
        $list = executeResult($sql);
        foreach ($list as $item) {
            echo '<li class="item"><a href="admin.php?muc=' . $item['id'] . '&tmuc=' . $item['ten_danhmuc'] . '">' . $item['ten_danhmuc'] . '</a></li>';
        }
        ?>
    </ul>
</div>