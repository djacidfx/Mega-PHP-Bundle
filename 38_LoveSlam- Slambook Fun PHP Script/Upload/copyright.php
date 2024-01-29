<div class="card mt-3 shadow-lg mb-3">
    <div class="card-header">
        <div class="col-lg-12 mt-2 text-center">
            <h3 class="text-danger"><i class="bi bi-suit-heart-fill"></i> <i class="bi bi-suit-heart-fill"></i> <?php echo  total_slams($pdo) ; ?> Slams Created <i class="bi bi-suit-heart-fill"></i> <i class="bi bi-suit-heart-fill"></i> </h3>
        </div>
        <div class="col-lg-12 mt-2 text-center">
            Copyright &copy; <?php echo date("Y"); ?> 
            <span class="text-muted p-1"><b><?php echo copyright_name($pdo) ; ?></b></span>. All Rights Reserved.
        </div> 
    </div>
</div>