// Variáveis globais
let nav = 0
let clicked = null
let events = localStorage.getItem('events') ? JSON.parse(localStorage.getItem('events')) : []

// Variáveis do modal:
const novoEventoModal = document.getElementById('newEventModal')
const modalExcluirEvento = document.getElementById('deleteEventModal')
const fundoModal = document.getElementById('modalBackDrop')
const entradaTituloEvento = document.getElementById('eventTitleInput')

// Elementos relacionados ao calendário:
const calendario = document.getElementById('calendar')
const diasDaSemana = ['domingo', 'segunda-feira', 'terça-feira', 'quarta-feira', 'quinta-feira', 'sexta-feira', 'sábado']

// Funções

function abrirModal(data){
  clicked = data
  const eventoDia = events.find((evento) => evento.date === clicked)

  if (eventoDia) {
    document.getElementById('eventText').innerText = eventoDia.title
    modalExcluirEvento.style.display = 'block'
  } else {
    novoEventoModal.style.display = 'block'
  }

  fundoModal.style.display = 'block'
}

// Função load() é chamada quando a página carrega:
function carregar() {
  const data = new Date()

  // Mudar o título do mês:
  if (nav !== 0) {
    data.setMonth(new Date().getMonth() + nav)
  }

  const dia = data.getDate()
  const mes = data.getMonth()
  const ano = data.getFullYear()

  const diasMes = new Date(ano, mes + 1, 0).getDate()
  const primeiroDiaMes = new Date(ano, mes, 1)

  const dataString = primeiroDiaMes.toLocaleDateString('pt-br', {
    weekday: 'long',
    year: 'numeric',
    month: 'numeric',
    day: 'numeric',
  })

  const diasDePreenchimento = diasDaSemana.indexOf(dataString.split(', ')[0])

  // Mostrar mês e ano:
  document.getElementById('monthDisplay').innerText = `${data.toLocaleDateString('pt-br', { month: 'long' })}, ${ano}`

  calendario.innerHTML = ''

  // Criando as divs dos dias:
  for (let i = 1; i <= diasDePreenchimento + diasMes; i++) {
    const diaDiv = document.createElement('div')
    diaDiv.classList.add('day')

    const dataDiaString = `${mes + 1}/${i - diasDePreenchimento}/${ano}`

    // Condicional para criar os dias do mês:
    if (i > diasDePreenchimento) {
      diaDiv.innerText = i - diasDePreenchimento

      const eventoDia = events.find(evento => evento.date === dataDiaString)

      if (i - diasDePreenchimento === dia && nav === 0) {
        diaDiv.id = 'currentDay'
      }

      if (eventoDia) {
        const eventoDiv = document.createElement('div')
        eventoDiv.classList.add('event')
        eventoDiv.innerText = eventoDia.title
        diaDiv.appendChild(eventoDiv)
      }

      diaDiv.addEventListener('click', () => abrirModal(dataDiaString))

    } else {
      diaDiv.classList.add('padding')
    }

    calendario.appendChild(diaDiv)
  }
}

function fecharModal() {
  entradaTituloEvento.classList.remove('error')
  novoEventoModal.style.display = 'none'
  fundoModal.style.display = 'none'
  modalExcluirEvento.style.display = 'none'

  entradaTituloEvento.value = ''
  clicked = null
  carregar()
}

function salvarEvento() {
  if (entradaTituloEvento.value) {
    entradaTituloEvento.classList.remove('error')

    events.push({
      date: clicked,
      title: entradaTituloEvento.value
    })

    localStorage.setItem('events', JSON.stringify(events))
    fecharModal()

  } else {
    entradaTituloEvento.classList.add('error')
  }
}

function excluirEvento() {
  events = events.filter(evento => evento.date !== clicked)
  localStorage.setItem('events', JSON.stringify(events))
  fecharModal()
}

// Botões
function botoes() {
  document.getElementById('backButton').addEventListener('click', () => {
    nav--
    carregar()
  })

  document.getElementById('nextButton').addEventListener('click', () => {
    nav++
    carregar()
  })

  document.getElementById('saveButton').addEventListener('click', () => salvarEvento())
  document.getElementById('cancelButton').addEventListener('click', () => fecharModal())
  document.getElementById('deleteButton').addEventListener('click', () => excluirEvento())
  document.getElementById('closeButton').addEventListener('click', () => fecharModal())
}

botoes()
carregar()
