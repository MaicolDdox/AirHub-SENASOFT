@extends('app')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center bg-slate-50 p-6">
    <div class="bg-white rounded-xl shadow p-6 w-full max-w-md">
        <h2 class="text-xl font-bold mb-4">Chat IA 🤖</h2>

        <div id="chatBox" class="h-80 overflow-y-auto border rounded p-3 text-sm mb-3 bg-slate-50">
            <div class="text-slate-500">Pregúntame algo sobre la página...</div>
        </div>

        <form id="chatForm" class="flex gap-2">
            @csrf
            <input id="message" name="message" class="flex-1 border rounded px-3 py-2"
                   placeholder="Escribe tu mensaje..." autocomplete="off">
            <button class="bg-sky-600 text-white px-4 rounded hover:bg-sky-700">Enviar</button>
        </form>
    </div>
</div>

<script>
const chatBox = document.getElementById('chatBox');
const form = document.getElementById('chatForm');
const input = document.getElementById('message');

function addMsg(role, text){
  const div = document.createElement('div');
  div.className = 'mb-2 ' + (role==='user' ? 'text-right' : 'text-left');
  div.innerHTML = `<div class="${role==='user'?'bg-sky-600 text-white':'bg-slate-200'} inline-block px-3 py-2 rounded">${text}</div>`;
  chatBox.appendChild(div);
  chatBox.scrollTop = chatBox.scrollHeight;
}

form.addEventListener('submit', async e => {
  e.preventDefault();
  const msg = input.value.trim();
  if(!msg) return;
  addMsg('user', msg);
  input.value = '';

  const thinking = document.createElement('div');
  thinking.textContent = '🤔 pensando...';
  chatBox.appendChild(thinking);

  const res = await fetch(`{{ route('chat.ia.api') }}`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
    },
    body: JSON.stringify({ message: msg })
  });
  const data = await res.json();
  thinking.remove();
  addMsg('bot', data.reply);
});
</script>
@endsection
