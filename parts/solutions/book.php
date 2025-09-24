<?php
  $defaults = function_exists('figma_rebuild_get_solutions_defaults') ? figma_rebuild_get_solutions_defaults() : [];
  $book_defaults = isset($defaults['book']) ? $defaults['book'] : [];

  $title = get_theme_mod('solutions_book_title', isset($book_defaults['title']) ? $book_defaults['title'] : 'Want more details?');
  $button_text = get_theme_mod('solutions_book_button_text', 'Book Consultation');
  $button_link = get_theme_mod('solutions_book_button_link', '#contact');
?>

<section id="solutions-book" class="sb-wrap">
  <style>
    #solutions-book.sb-wrap {
      padding: 80px 0;
      background: #ffffff;
      border: 1px solid #e0f2fe;
    }
    
    #solutions-book .sb-container {
      max-width: 600px;
      margin: 0 auto;
      padding: 0 24px;
      text-align: center;
    }
    
    #solutions-book .sb-title {
      margin: 0 0 32px;
      font-size: 48px;
      font-weight: 700;
      color: #0f172a;
      letter-spacing: -0.02em;
    }
    
    #solutions-book .sb-button {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 16px 32px;
      border-radius: 12px;
      background: #2563eb;
      color: #ffffff;
      font-weight: 600;
      font-size: 16px;
      text-decoration: none;
      border: none;
      cursor: pointer;
      transition: background-color 0.2s ease;
    }
    
    #solutions-book .sb-button:hover {
      background: #1d4ed8;
    }
    
    @media (max-width: 768px) {
      #solutions-book .sb-title {
        font-size: 36px;
      }
      
      #solutions-book .sb-button {
        padding: 14px 28px;
        font-size: 15px;
      }
    }
  </style>

  <div class="sb-container">
    <h2 class="sb-title"><?php echo esc_html($title); ?></h2>
    <a href="<?php echo esc_url($button_link); ?>" class="sb-button">
      <?php echo esc_html($button_text); ?>
    </a>
  </div>
</section>
