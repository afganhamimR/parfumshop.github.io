<head>
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<style>
    h2{
        font-family: 'Poppins', sans-serif;
        color:#5ea2a3;
    }
    #kj{
        font-family: 'Poppins', sans-serif;
    }
    span{
        color: red;
    }
    th{
        text-align: center;
    }
</style>
<h2>Data User</h2>

<table id="kj" class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama User</th>
            <th>Email</th>
            <th>No. WhatsApp</th>
            <th>Profesi</th>
            <th>Sekolah User<span>*</span></th>
        </tr>
    </thead>
    <tbody>
        <?php $nmr=1; ?>
        <?php $ambl=$kn->query("SELECT * FROM user"); ?>
        <?php while($pch=$ambl->fetch_assoc()){ ?>
        <tr>
            <td><?php echo $nmr; ?></td>
            <td><?php echo $pch['nama_user']; ?></td>
            <td><?php echo $pch['email_user']; ?></td>
            <td><?php echo $pch['wa_user']; ?></td>
            <td><?php echo $pch['profesi_user']; ?></td>
            <td><?php echo $pch['sekolah_user']; ?></td>
            <td>
            <a href="index.php?halaman=hapuspelanggan&id=<?php echo $pch['id_user']; ?>" class="btn-danger btn">Hapus</a>
            </td>
        </tr>
        <?php $nmr++; ?>
        <?php } ?>
    </tbody>
</table>