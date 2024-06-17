class Cep {
    static init() {
        const cepField = document.getElementById('cep');
        if (cepField) {
            cepField.addEventListener('input', Cep.applyMask);
            cepField.addEventListener('blur', Cep.fetchAddress);
        }
    }

    static applyMask(event) {
        const cep = event.target.value.replace(/\D/g, '').slice(0, 8);
        event.target.value = cep.replace(/(\d{5})(\d{3})/, '$1-$2');
    }

    static async fetchAddress() {
        const cepField = document.getElementById('cep');
        const cep = cepField.value.replace(/\D/g, '');

        if (cep.length === 8) {
            try {
                const response = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
                const data = await response.json();

                if (data.erro) {
                    throw new Error('CEP não encontrado');
                }

                document.getElementById('endereco').value = data.logradouro;
                document.getElementById('bairro').value = data.bairro;
                document.getElementById('cidade').value = data.localidade;
                document.getElementById('uf').value = data.uf;
            } catch (error) {
                alert(error.message || 'Erro ao buscar o CEP.');
                cepField.value = '';
            }
        } else {
            alert('Digite o CEP corretamente.');
            cepField.value = '';
        }
    }
}

document.addEventListener('DOMContentLoaded', Cep.init);
