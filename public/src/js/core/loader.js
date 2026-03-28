export const loader = {
    show() {
        document.getElementById('loader-overlay').classList.remove('hidden');
    },
    hide() {
        document.getElementById('loader-overlay').classList.add('hidden');
    }
};