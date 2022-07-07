
1
2
3
4
5
6
7
8
9
10
11
12
13
14
15
16
17
18
19
20
21
22
23
24
25
26
27
28
29
30
31
32
33
34
35
36
37
38
39
40
41
42
43
44
45
46
47
48
49
50
51
52
53
54
55
56
57
58
59
60
61
62
63
64
65
66
67
68
69
70
71
72
73
74
75
76
77
78
79
80
81
82
83
84
85
86
87
88
89
90
91
92
93
<?php 
require_once 'template2/header.php';
  //proteksi halaman
if(isset($_SESSION['nopeg']))
{
	//direct halaman
	echo "<script type='text/javascript'>
	window.top.location='dashboard2.php';
	</script>"; 
	exit;
 
}
	if (!empty($_SESSION['nopeg']) AND empty($_SESSION['user'])) {
	//direct halaman
	echo "<script type='text/javascript'>
	window.top.location='dashboard2.php';
	</script>"; 
	exit;
}else { ?>
 
	<div class="container">    
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-5 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-default" >
                    <div class="panel-heading">
                        <div class="panel-title">--WEB PAMEGATIM1--</div>
                        
                    </div>     
 
                    <div style="padding-top:30px" class="panel-body" >
 
                <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
				<?php if(isset($_GET['pesan'])){
				if($_GET['pesan']=="gagal"){
					echo "<div class='alert alert-danger'>Nopeg dan password tidak cocok, <b>ulangi lagi!</b></div>";
				}elseif($_GET['pesan']=="fail"){
					echo "<div class='alert alert-danger'>Nopeg belum terdaftar pada sistem !</div>";
				}
			    }
			    ?>
                        <form id="loginform" class="form-horizontal" role="form" method="post" action="auth_p.php">
                                    
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="login-username" type="text" class="form-control" value="<?php if(isset($_COOKIE["user_login"])) { echo $_COOKIE["user_login"]; } ?>" name="nopeg" required autofocus placeholder="Nopeg">                                        
                                    </div>
                                
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input value="<?php if(isset($_COOKIE["userpassword"])) { echo $_COOKIE["userpassword"]; } ?>" name="password" id="login-password" type="password" class="form-control" name="password" placeholder="Password" required>
                                    </div>
                            <div style="margin-bottom: 25px" class="input-group">  
                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>                                  
                            <select name="ta" class="form-control" required="required" id="select">
						<option value="">--Tahun Ajaran--</option>
						<option value="2">SMT 1 - 2020-2021</option>
						<option value="3">SMT 2 - 2020-2021</option>
					</select>
					</div>        
                            <div class="input-group">
                                      <div class="checkbox">
                                        <label>
										<input type="checkbox" class="custom-control-input" id="customCheck1" name="remember" id="remember" <?php if(isset($_COOKIE["user_login"])) { ?> checked <?php } ?>>
    									<label class="custom-control-label" for="customCheck1">Ingat saya?</label>
                                        </label>
                                      </div>
                                    </div>
 
 
                                <div style="margin-top:10px" class="form-group">
                                    <div class="col-sm-12 controls">
									<button class="btn  btn-success btn-block btn-login font-weight-bold mb-2" type="submit" name="btnlogin"> Bismillah</button>
 
                                    </div>
                                </div>
 
                                <div class="form-group">
                                    <div class="col-md-12 control">
                                        <div >
                                        	Ternyata saya <a href="https://api.whatsapp.com/send?phone=6281285777741&text=Assalamualaikum%0ASaya%0Alupa%0Apassword%0Alogin%0Apak">Lupa password?</a>
                                        </div>
                                    </div>
                                </div>    
                            </form>     
 
                        </div>                     
                    </div> 
		<p class="text-center"><a href="index.php" ><u>Beranda</u></a></p> 
        	</div>
			
<?php 
}
include_once 'template2/footer.php';
?>