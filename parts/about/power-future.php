<?php
/**
 * About page CTA - Power the Future Together Section
 */
?>

<section id="power-future" class="power-future-section">
  <div class="power-future__container">
    <h2 class="power-future__title">Let's Power the Future Together.</h2>
    
    <div class="power-future__buttons">
      <a href="#contact" class="power-future__button power-future__button--primary">Contact Us</a>
      <a href="#careers" class="power-future__button power-future__button--secondary">Careers</a>
    </div>
  </div>
</section>

<style>
.power-future-section {
  padding: 80px 0;
  background: #ffffff;
  border: 1px solid #e0f2fe;
}

.power-future__container {
  max-width: 600px;
  margin: 0 auto;
  padding: 0 24px;
  text-align: center;
}

.power-future__title {
  margin: 0 0 32px;
  font-size: 48px;
  font-weight: 700;
  color: #0f172a;
  letter-spacing: -0.02em;
}

.power-future__buttons {
  display: flex;
  gap: 16px;
  justify-content: center;
  flex-wrap: wrap;
}

.power-future__button {
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

.power-future__button--primary {
  background: #2563eb;
  color: #ffffff;
}

.power-future__button--primary:hover {
  background: #1d4ed8;
}

.power-future__button--secondary {
  background: #ffffff;
  color: #0f172a;
  border: 2px solid #0f172a;
}

.power-future__button--secondary:hover {
  background: #0f172a;
  color: #ffffff;
}

@media (max-width: 768px) {
  .power-future-section {
    padding: 60px 0;
  }
  
  .power-future__container {
    padding: 0 16px;
  }
  
  .power-future__title {
    font-size: 36px;
  }
  
  .power-future__buttons {
    flex-direction: column;
    align-items: center;
  }
  
  .power-future__button {
    width: 100%;
    max-width: 280px;
    padding: 14px 28px;
    font-size: 15px;
  }
}

@media (max-width: 480px) {
  .power-future__title {
    font-size: 32px;
  }
  
  .power-future__button {
    padding: 12px 24px;
    font-size: 14px;
  }
}
</style>
