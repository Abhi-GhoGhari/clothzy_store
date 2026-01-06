<?php include 'header.php'; ?>
<main class="container" style="max-width: 700px; padding: 40px 20px;">
  <h1>Contact Us</h1>
  <p>We’re here to help! Reach out to us using the form below or via our contact details.</p>

  <form action="contact_submit.php" method="POST" style="margin-top: 30px;">
    <label for="name" style="font-weight: 600; font-size: 1.1rem; color: #0b1226;">Name</label><br/>
    <input type="text" id="name" name="name" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ccc; margin-bottom: 20px;" />

    <label for="email" style="font-weight: 600; font-size: 1.1rem; color: #0b1226;">Email</label><br/>
    <input type="email" id="email" name="email" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ccc; margin-bottom: 20px;" />

    <label for="message" style="font-weight: 600; font-size: 1.1rem; color: #0b1226;">Message</label><br/>
    <textarea id="message" name="message" rows="6" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ccc; margin-bottom: 20px;"></textarea>

    <button type="submit" style="background-color: #c9a34a; color: #0b1226; font-weight: 700; border:none; padding: 12px 20px; border-radius: 30px; cursor: pointer; font-size: 1.1rem;">
      Send Message
    </button>
  </form>

  <section style="margin-top: 40px; font-size: 1rem; color: #333;">
    <h2>Our Contact Details</h2>
    <p><strong>Email: </strong>support@clothzystore.com</p>
    <p><strong>Phone: </strong>+91 8128214806</p>
    <p><strong>Address: </strong>42 Rukshmani,katargam, Surat, Gujarat, India</p>
  </section>
</main>
<?php include 'footer.php'; ?>
