
    <!-- FORM EDIT -->
    <div id="myModal2" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Barang</h4>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <div class="form-group">
                            <label>Nama Barang</label>
                            <input name="nama" type="text" class="form-control" required autofocus>
                            </div>

                </div>
                <div class="modal-body">
                    <form method="post">
                        <div class="form-group">
                            <label>Jumlah Stok</label>
                            <input name="jumlah" type="number" class="form-control" required autofocus>
                        </div>

                </div>
                <div class="modal-body">
                    <form method="post">
                        <div class="form-group">
                            <label>Supplier</label>
                            <select id="supplier" name="supplier" required>
            <option value=""></option>
            <?php 

                $readuser = "select * from SUPPLIER";
                $q = mysqli_query($conn, $readuser);

                while ($bahan = mysqli_fetch_array($q)) {
                    ?>
                    <option value="<?php echo $bahan['NAMA_SUPPLIER']; ?>" > <?php echo $bahan['NAMA_SUPPLIER']; ?></option>
                    <?php
                }
            ?>
            </select>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <input name="addbahan" type="submit" class="btn btn-primary" value="Edit">
                </div>
                </form>
            </div>
        </div>
    </div>
