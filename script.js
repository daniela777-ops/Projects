function switchTab(tabName) {
  document.querySelectorAll('.tab').forEach(t=> t.classList.remove('active'))
  document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'))
  document.querySelector('[onclick="switchTab(\'' + tabName + '\')"]').classList.add('active')
  document.getElementById('tab-'+ tabName).classList.add('active')
}

function toggleBoard(id) {
    document.getElementById(id).classList.toggle('open')

function toggleSave(btn) {
  btn.classList.toggle('saved')
  btn.textContent = btn.classList.contains('saved') ? 'Saved!' : 'Save'
}
}