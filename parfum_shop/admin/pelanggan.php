<head>
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<style>
    h2{
        font-family: 'Poppins', sans-serif;
        color:#045497;
    }
    #kj{
        font-family: 'Poppins', sans-serif;
    }
</style>
<h2>Data Pelanggan</h2>
<hr>
<table id="kj" class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama </th>
            <th>Email</th>
            <th>Telepon</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
        <?php $nmr=1; ?>
        <?php $ambl=$kn->query("SELECT * FROM pelanggan"); ?>
        <?php while($pch=$ambl->fetch_assoc()){ ?>
        <tr>
            <td><?php echo $nmr; ?></td>
            <td><?php echo $pch['nama_pelanggan']; ?></td>
            <td><?php echo $pch['email_pelanggan']; ?></td>
            <td><?php echo $pch['telp_pelanggan']; ?></td>
            <td>
            <a href="index.php?halaman=hapuspelanggan&id=<?php echo $pch['id_pelanggan']; ?>" class="btn-danger btn">Hapus</a>
            </td>
        </tr>
        <?php $nmr++; ?>
        <?php } ?>
    </tbody>
</table>