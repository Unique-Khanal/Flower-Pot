import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.store('cart', {
    items: JSON.parse(localStorage.getItem('fp_cart') || '[]'),

    add(item) {
        const existing = this.items.find(i => i.name === item.name);
        if (existing) {
            existing.qty++;
        } else {
            this.items.push({ ...item, qty: 1 });
        }
        localStorage.setItem('fp_cart', JSON.stringify(this.items));
    },

    remove(name) {
        this.items = this.items.filter(i => i.name !== name);
        localStorage.setItem('fp_cart', JSON.stringify(this.items));
    },

    get count() {
        return this.items.reduce((sum, i) => sum + i.qty, 0);
    },

    get total() {
        return this.items.reduce((sum, i) => sum + (i.price * i.qty), 0);
    },

    clear() {
        this.items = [];
        localStorage.setItem('fp_cart', JSON.stringify(this.items));
    },
});

Alpine.start();
