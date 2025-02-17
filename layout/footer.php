<footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Ftry Website 2025</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
                
        <script type="text/javascript">
            let count = 0;
            let mbtn = document.getElementById("minus-btn");
            let abtn = document.getElementById("add-btn");
            let disp = document.getElementById("display");

            mbtn.onclick = function () {
                        if(count > 0){
                            count--;
                        }
                        else{
                            count = 0;
                        }
                        
            disp.value = count;
            }
            
            abtn.onclick = function () {
                        count++;
            disp.value = count;
            }
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="/order-system/js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="/order-system/assets/demo/chart-area-demo.js"></script>
        <script src="/order-system/assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="/order-system/js/datatables-simple-demo.js"></script>
    </body>
</html>