class ReservationForm {
    constructor() {
        this.form = document.getElementById('reservationForm');
        this.initializeForm();
    }

    initializeForm() {
        this.form.addEventListener('submit', (e) => this.handleSubmit(e));

        this.form.querySelectorAll('input').forEach(input => {
            input.addEventListener('blur', (e) => this.validateField(e.target));
        });
    }

    validateField(field) {
        const value = field.value.trim();
        let isValid = true;
        switch (field.id) {
            case 'name':
            case 'surname':
                isValid = value.length >= 2;
                break;
            case 'email':
                isValid = /\b[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}\b/.test(value);
                break;
            case 'phone':
                isValid = /^\d{10}$/.test(value);
                break;
            case 'studio':
                isValid = value.length >= 3;
                break;
            case 'date':
                isValid = new Date(value) >= new Date();
                break;
            case 'time':
                isValid = value !== '';
                break;
        }

        this.toggleFieldValidation(field, isValid);
        return isValid;
    }

    toggleFieldValidation(field, isValid) {
        field.classList.toggle('is-invalid', !isValid);
        field.classList.toggle('is-valid', isValid);
    }
    

    handleSubmit(e) {
        e.preventDefault();
        let isValid = true;

        this.form.querySelectorAll('input').forEach(input => {
            if (!this.validateField(input)) {
                isValid = false;
            }
        });

        if (isValid) {
            alert('Reservation submitted successfully!');
            this.form.reset();
        } else {
            alert('Please fill in all fields correctly.');
        }
    }
}

document.addEventListener('DOMContentLoaded', () => {
    new ReservationForm();
});
