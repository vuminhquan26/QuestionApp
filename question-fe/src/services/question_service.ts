const BASE_URL = 'http://127.0.0.1:8000/api/question'

export interface QuestionPayload {
  title: string
  question_type_code: string
  answer_type_code: string
  subject_id: string
  difficulty: string
  score: number
  status: number
  version: number
  question_data: {
    question_content: string
  }
  answer_data: {
    answer_contents: {
      answer_id: string
      answer_content: string
    }[]
    correct_answer: {
      answer_id: string
      answer_content: string
    }[]
    shuffle: boolean
  }
}

export const questionService = {
  async getList(page = 1): Promise<any> {
    const res = await fetch(`${BASE_URL}?page=${page}`)
    return res.json()
  },

  async getDetail(id: string): Promise<any> {
    const res = await fetch(`${BASE_URL}/${id}`)
    return res.json()
  },

  async create(data: QuestionPayload): Promise<any> {
    const res = await fetch(BASE_URL, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(data),
    })
    return res.json()
  },

  async update(id: string, data: QuestionPayload): Promise<any> {
    const res = await fetch(`${BASE_URL}/${id}`, {
      method: 'PUT',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(data),
    })
    return res.json()
  },

  async remove(id: string): Promise<any> {
    const res = await fetch(`${BASE_URL}/${id}`, {
      method: 'DELETE',
    })
    return res.json()
  },
}
