<?php require_once $_SERVER['DOCUMENT_ROOT']."/template/public/inc/header.php"; ?>

<?php  
    if(isset($_POST['submit'])){
        $hoten_lh = $_POST['hoten_lh'];
        $mail_lh = $_POST['mail_lh'];
        $sdt_lh = $_POST['sdt_lh'];
        $noidung_lh = $_POST['noidung_lh'];



        $sql = "INSERT INTO lienhe(hoten_lh, mail_lh, sdt_lh, noidung_lh) VALUES ('{$hoten_lh}', '{$mail_lh}', '{$sdt_lh}', '{$noidung_lh}')";
        $result = $mysqli->query($sql);
        if($result){
            header('location:/lien-he.html?m'); exit();
        }
    }
?>

    <div class="container">

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Liên hệ
                        <strong>CAFÉ VÀ TRÀ</strong>
                    </h2>
                    <hr>
                </div>
                <div class="col-md-8">
                    <!-- Embedded Google Map using an iframe - to select your location find it on Google maps and paste the link as the iframe src. If you want to use the Google Maps API instead then have at it! -->
                    <iframe width="100%" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3833.806541234332!2d108.15145725066772!3d16.075525788822528!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314218d68dff9545%3A0x714561e9f3a7292c!2sDanang+University+of+Technology!5e0!3m2!1sen!2s!4v1481518316452"></iframe>

                </div>
                <div class="col-md-4">
                    <p>Phone:
                        <strong>090 195 2110</strong>
                    </p>
                    <p>Email:
                        <strong><a href="mailto:name@example.com">caithesi@gmail.com</a></strong>
                    </p>
                    <p>Address:
                        <strong>
                            <br>HÒA KHÁNH, LIÊN CHIỂU, ĐÀ NẴNG</strong>
                    </p>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Liên hệ
                        <strong>Từ</strong>
                    </h2>
                    <hr>
                    <?php if (isset($_GET['m'])):

                    ?>
                    <script type="text/javascript">
                        alert('Cảm ơn bạn đã gửi liên hệ');
                    </script>
                    <?php endif ?>
                    <script type="text/javascript">
                        window.history.pushState('page2', 'Title', '/lien-he.html');
                    </script>
                    <form role="form" method="post" id="form-lien-he">
                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label>Họ và tên</label>
                                <input type="text" class="form-control" name="hoten_lh">
                            </div>
                            <div class="form-group col-lg-4">
                                <label>Địa chỉ Email</label>
                                <input type="email" class="form-control" name="mail_lh">
                            </div>
                            <div class="form-group col-lg-4">
                                <label>Số điện thọai</label>
                                <input type="text" class="form-control" name="sdt_lh">
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group col-lg-12">
                                <label>Nội dung</label>
                                <textarea class="form-control" rows="6" name="noidung_lh"></textarea>
                            </div>
                            <div class="form-group col-lg-12 text-right">
                                <input type="hidden" name="save" value="contact">
                                <button type="submit" class="btn btn-default" name="submit">Gửi</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container -->
<script type="text/javascript">
    $(document).ready(function () {
        $('#form-lien-he').validate({
            rules: {
                "hoten_lh": {
                    required: true,
                },
                "sdt_lh": {
                    required: true,
                    digits: true
                },
                "mail_lh": {
                    required: true,
                    email: true
                },
                "noidung_lh": {
                    required: true,
                },
            },
            messages: {
                "hoten_lh": {
                    required: "Vui lòng nhập vào đây",
                },
                "sdt_lh": {
                    required: "Vui lòng nhập vào đây",
                    digits: "Vui lòng nhập số nguyên dương"
                },
                "mail_lh": {
                    required: "Vui lòng nhập vào đây",
                    email: "Vui lòng nhập đúng định dạng email"
                },
                "noidung_lh": {
                    required: "Vui lòng nhập vào đây",
                },
            }
        });
    }); 
</script>

 <?php require_once $_SERVER['DOCUMENT_ROOT']."/template/public/inc/footer.php"; ?>       