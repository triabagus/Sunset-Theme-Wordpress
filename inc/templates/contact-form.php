<form id="sunsetContactForm" class="sunset-contact-form" action="#" method="post" data-url="<?= admin_url('admin-ajax.php'); ?>">

    <div class="form-group">
        <input type="text" name="name" id="name" class="form-control sunset-form-control" placeholder="Your Name">
        <small class="form-control-msg invalid-feedback">Your Name is required</small>
    </div>
    
    <div class="form-group">
        <input type="email" name="email" id="email" class="form-control sunset-form-control" placeholder="Your Email">
        <small class="form-control-msg invalid-feedback">Your Email is required</small>
    </div>

    <div class="form-group">
        <textarea name="message" id="message" class="form-control sunset-form-control"></textarea>
        <small class="form-control-msg invalid-feedback">Your Message is required</small>
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-warning btn-lg btn-sunset-form">Submit</button>
        <small class="text-info form-control-msg js-form-submission">Submission in process, please wait..</small>
        <small class="text-success form-control-msg js-form-success">Message successfully submitted, thank you !</small>
        <small class="text-danger form-control-msg js-form-error">There was a problem with the contact form , plase try again !</small>
    </div>

</form>