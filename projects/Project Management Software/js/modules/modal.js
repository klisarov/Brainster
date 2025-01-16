export class Modal {
    static show(id) {
        document.getElementById(id).style.display = 'block';
    }

    static hide(id) {
        document.getElementById(id).style.display = 'none';
    }
}