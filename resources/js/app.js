import './bootstrap';

const quantityControl = document.querySelector('.quantity-control');

if (quantityControl) {
    const amountInput = quantityControl.querySelector('#quantity-amount');
    const quantityOutput = quantityControl.querySelector('#product-quantity');
    const feedback = quantityControl.querySelector('#quantity-feedback');
    const buttons = quantityControl.querySelectorAll('button[data-direction]');

    buttons.forEach((button) => {
        button.addEventListener('click', async () => {
            const amount = Number(amountInput.value);

            if (!Number.isInteger(amount) || amount < 1) {
                feedback.textContent = 'Enter a whole number greater than zero.';
                return;
            }

            buttons.forEach((item) => { item.disabled = true; });
            feedback.textContent = '';

            try {
                const response = await fetch(quantityControl.dataset.quantityUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content ?? '',
                    },
                    body: JSON.stringify({ direction: button.dataset.direction, amount }),
                });
                const data = await response.json();

                if (!response.ok) {
                    throw new Error(data.message ?? Object.values(data.errors ?? {}).flat()[0] ?? 'Could not update stock.');
                }

                quantityOutput.textContent = data.quantity;
                feedback.textContent = data.message;
            } catch (error) {
                feedback.textContent = error.message;
            } finally {
                buttons.forEach((item) => { item.disabled = false; });
            }
        });
    });
}
