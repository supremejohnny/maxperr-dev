<?php
/**
 * Become a Partner Today Section
 */
?>

<section id="become-partner" class="become-partner-section">
  <div class="become-partner__container">
    <h2 class="become-partner__title">Become a Partner Today</h2>
    
    <div class="become-partner__buttons">
      <a href="#contact" class="become-partner__button become-partner__button--primary">Apply Now</a>
      <a href="#learn-more" class="become-partner__button become-partner__button--secondary">Learn More</a>
    </div>
  </div>
</section>

<style>
.become-partner-section {
  padding: 80px 0;
  background: #ffffff;
  border: 1px solid #e0f2fe;
}

.become-partner__container {
  max-width: 600px;
  margin: 0 auto;
  padding: 0 24px;
  text-align: center;
}

.become-partner__title {
  margin: 0 0 32px;
  font-size: 48px;
  font-weight: 700;
  color: #0f172a;
  letter-spacing: -0.02em;
}

.become-partner__buttons {
  display: flex;
  gap: 16px;
  justify-content: center;
  flex-wrap: wrap;
}

.become-partner__button {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  padding: 16px 32px;
  border-radius: 12px;
  font-weight: 600;
  font-size: 16px;
  text-decoration: none;
  border: none;
  cursor: pointer;
  transition: all 0.2s ease;
  min-width: 140px;
}

.become-partner__button--primary {
  background: #2563eb;
  color: #ffffff;
}

.become-partner__button--primary:hover {
  background: #1d4ed8;
}

.become-partner__button--secondary {
  background: #ffffff;
  color: #0f172a;
  border: 2px solid #0f172a;
}

.become-partner__button--secondary:hover {
  background: #0f172a;
  color: #ffffff;
}

@media (max-width: 768px) {
  .become-partner-section {
    padding: 60px 0;
  }
  
  .become-partner__container {
    padding: 0 16px;
  }
  
  .become-partner__title {
    font-size: 36px;
  }
  
  .become-partner__buttons {
    flex-direction: column;
    align-items: center;
  }
  
  .become-partner__button {
    width: 100%;
    max-width: 280px;
    padding: 14px 28px;
    font-size: 15px;
  }
}

@media (max-width: 480px) {
  .become-partner__title {
    font-size: 32px;
  }
  
  .become-partner__button {
    padding: 12px 24px;
    font-size: 14px;
  }
}
</style>
