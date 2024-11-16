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
                const phonenumber = value.replace(/\s/g, '');
                isValid =  /^(\+\d{1,3}|0)\d{1,14}$/.test(phonenumber);
                break;
            case 'studio':
                isValid = value.length >= 3;
                break;
            /*case 'date':
                isValid = new Date(value) >= new Date().toISOString().split('T')[0];
                break; */
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
            
            window.location.href = '/FindAStudio/index.php';
        } else {
            alert('Please fill in all fields correctly.');
        }
    }
}

document.addEventListener('DOMContentLoaded', () => {
    new ReservationForm();
});
