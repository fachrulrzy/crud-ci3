<!DOCTYPE html>
<html lang="en"><head>
    <title></title>
</head><body>

        <table>
            <thead>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Pekerjaan</th>
                <th>Operasi</th>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                foreach ($user as $u) {
                ?>
                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $u->nama ?></td>
                    <td><?php echo $u->alamat ?></td>
                    <td><?php echo $u->pekerjaan ?></td>
                </tr>
                <?php }?>
                <!-- <tr>
                    <td class="text-md-center" colspan="5">Data Kosong</td>
                </tr> -->
            </tbody>
        </table>

</body></html>