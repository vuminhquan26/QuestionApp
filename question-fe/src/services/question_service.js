const BASE_URL = 'http://127.0.0.1:8000/api/question'

export const questionService = {
  async getList(page = 1) {
    const res = await fetch(`${BASE_URL}?page=${page}`)
    return await res.json()
  },

  async getDetail(id) {
    const res = await fetch(`${BASE_URL}/${id}`)
    return await res.json()
  },

  async create(data) {
    const res = await fetch(BASE_URL, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(data),
    })
    return await res.json()
  },

  async update(id, data) {
    const res = await fetch(`${BASE_URL}/${id}`, {
      method: 'PUT',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(data),
    })
    return await res.json()
  },

  async remove(id) {
    const res = await fetch(`${BASE_URL}/${id}`, {
      method: 'DELETE',
    })
    return await res.json()
  },
}
