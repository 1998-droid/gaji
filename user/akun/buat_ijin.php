<?php
include "_header.php";
include "../koneksi.php";


?>

<div class="col-sm-6">
	<div class="card"> 
		<div class="card-body card-reposive">
           <div>
            <div>
            <input type="button" class="btn btn-warning btn-xs" value="Kembali" onclick="history.back(-1)" />
            </div>
            <form action="ubah_pro.php" method="post">
            <div class="form-group">
            <label for="user">Username</label>
            <input type="text" name="user" id="user" value = "" class="form-control" required >
            </div>
            <div class="form-group">
            <label for="user">Username</label>
            <input type="text" name="user" id="user" value = "" class="form-control" required >
            </div>
            <div class="form-group">
            <label for="user">Username</label>
            <input type="text" name="user" id="user" value = "" class="form-control" required >
            </div>
          </form>
		</div>
	</div>
<style type="text/css">
body{
    margin-top:20px;
    background: #FFF8DC;
}

.ui-w-100 {
    width: 100px !important;
    height: auto;
}

.card {
  width:100%;
    height:auto;
    background-clip: padding-box;
    box-shadow: 0 1px 4px rgba(24,28,33,0.012);
}

.user-view-table td:first-child {
    width: 9rem;
}
.user-view-table td {
    padding-right: 0;
    padding-left: 0;
    border: 0;
}

.text-light {
    color: #babbbc !important;
}

.card .row-bordered>[class*=" col-"]::after {
    border-color: rgba(24,28,33,0.075);
}    

.text-xlarge {
    font-size: 170% !important;
}
</style>

</body>
</html>