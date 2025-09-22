(function () {
  const selector = '.figma-repeater';

  const updateIndices = (items) => {
    items.forEach((item, index) => {
      const titleEl = item.querySelector('.figma-repeater__item-title');
      if (!titleEl) {
        return;
      }
      const base = titleEl.getAttribute('data-label-base') || '';
      titleEl.textContent = base ? `${base} #${index + 1}` : `#${index + 1}`;
    });
  };

  const syncStore = (container, fields) => {
    const store = container.querySelector('.figma-repeater__store');
    const items = Array.from(container.querySelectorAll('.figma-repeater__item'));
    if (!store) {
      return;
    }

    const data = items.map((item) => {
      const entry = {};
      fields.forEach((field) => {
        const input = item.querySelector(`[data-field="${field.id}"]`);
        if (!input) {
          entry[field.id] = '';
          return;
        }

        if (input.type === 'checkbox') {
          entry[field.id] = input.checked ? '1' : '';
        } else {
          entry[field.id] = input.value || '';
        }
      });
      return entry;
    });

    store.value = JSON.stringify(data);
    store.dispatchEvent(new Event('change', { bubbles: true }));
  };

  const attachItemHandlers = (container, item, fields) => {
    item.querySelectorAll('input, textarea, select').forEach((input) => {
      input.addEventListener('input', () => syncStore(container, fields));
      input.addEventListener('change', () => syncStore(container, fields));
    });

    const removeBtn = item.querySelector('.figma-repeater__remove');
    if (removeBtn) {
      removeBtn.addEventListener('click', () => {
        item.remove();
        const items = Array.from(container.querySelectorAll('.figma-repeater__item'));
        updateIndices(items);
        syncStore(container, fields);
      });
    }
  };

  const initRepeater = (container) => {
    const itemsWrapper = container.querySelector('.figma-repeater__items');
    const addBtn = container.querySelector('.figma-repeater__add');
    const template = container.querySelector('.figma-repeater__template');
    const fieldsJson = container.getAttribute('data-fields') || '[]';

    if (!itemsWrapper || !addBtn || !template) {
      return;
    }

    let fields = [];
    try {
      const parsed = JSON.parse(fieldsJson);
      if (Array.isArray(parsed)) {
        fields = parsed.filter((field) => field && field.id);
      }
    } catch (err) {
      console.error('[customizer] repeater parse failed:', err);
    }

    if (!fields.length) {
      return;
    }

    const createItem = (values = {}) => {
      const fragment = template.content ? template.content.cloneNode(true) : null;
      const newItem = fragment ? fragment.querySelector('.figma-repeater__item') : null;

      if (!newItem) {
        return;
      }

      fields.forEach((field) => {
        const input = newItem.querySelector(`[data-field="${field.id}"]`);
        if (!input) {
          return;
        }

        const val = Object.prototype.hasOwnProperty.call(values, field.id) ? values[field.id] : '';
        if (input.type === 'checkbox') {
          input.checked = Boolean(val);
        } else {
          input.value = val || '';
        }
      });

      attachItemHandlers(container, newItem, fields);
      itemsWrapper.appendChild(newItem);
      const items = Array.from(container.querySelectorAll('.figma-repeater__item'));
      updateIndices(items);
      syncStore(container, fields);
      const firstField = newItem.querySelector('input, textarea, select');
      if (firstField) {
        firstField.focus();
      }
    };

    itemsWrapper.querySelectorAll('.figma-repeater__item').forEach((item) => {
      attachItemHandlers(container, item, fields);
    });
    updateIndices(Array.from(itemsWrapper.querySelectorAll('.figma-repeater__item')));

    addBtn.addEventListener('click', () => createItem({}));
  };

  const init = () => {
    document.querySelectorAll(selector).forEach(initRepeater);
  };

  if (typeof wp !== 'undefined' && wp.customize) {
    wp.customize.bind('ready', init);
  } else {
    document.addEventListener('DOMContentLoaded', init);
  }
})();
