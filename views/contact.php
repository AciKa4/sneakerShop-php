<section class="contact-us">
      <div class="container bottom-pad pt-4">
          <div class="row">
              <div class="col-md-12">
                  <div class="section-heading">
                      <h2>Send your message</h2>
                  </div>
                  <form id="contact" action="#" method="post">
                      <div class="row">
                          <div class="col-md-6">
                              <fieldset>
                                  <input  type="text" name="firstname" class="form-control" id="firstname" placeholder="Your first name..." >
                              </fieldset>
                              <fieldset>
                                <fieldset>
                                  <input  type="text" name="lastname" class="form-control" id="lastname" placeholder="Your last name..." >
                              </fieldset>
                              <fieldset>
                                  <input  type="text" name="email" class="form-control" id="email" placeholder="Your email...">                              
                              </fieldset>
                          </div>
                          <div class="col-md-6">
                              <fieldset>
                                  <textarea name="message" rows="6" class="form-control" id="message" placeholder="Your message..." ></textarea>
                              </fieldset>
                              <fieldset>
                                  <button type="button" id="form-submit" class="btn">Send Message</button>
                              </fieldset>
                          </div>
                          <?php if(isset($_SESSION['korisnik'])){?>
                          <input type="hidden" value="<?= $_SESSION['korisnik'] -> id?>" id="id" name="id">
                          <?php } else { ?> 
                          <input type="hidden" value="0" id="id" name="id">
                          <?php  }?>
                          <span class="mx-auto" id="forma">Your message has been send</span>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </section>
