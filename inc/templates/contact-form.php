<form id="sunsetContactForm" action="#" method="post" data-url="<?= admin_url('admin-ajax.php'); ?>">

    <div class="form-group">
        <input type="text" name="name" id="name" class="form-control" placeholder="Your Name" required>
    </div>
    
    <div class="form-group">
        <input type="email" name="email" id="email" class="form-control" placeholder="Your Email" required>
    </div>

    <div class="form-group">
        <textarea name="message" id="message" class="form-control" placeholder="Your Message" required></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>