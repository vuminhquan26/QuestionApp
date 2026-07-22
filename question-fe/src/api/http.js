import { getToken } from '../services/storage'
import { refreshToken } from '../services/tokenService'

let isRefreshing = false

export async function http(url, options = {}) {
  const token = getToken()

  const res = await fetch(`http://127.0.0.1:8000/api${url}`, {
    ...options,
    headers: {
      'Content-Type': 'application/json',
      Authorization: token ? `Bearer ${token}` : '',
      ...(options.headers || {}),
    },
  })

  if (res.status === 401 && !isRefreshing) {
    isRefreshing = true

    try {
      await refreshToken()
      isRefreshing = false
      return http(url, options)
    } catch (err) {
      isRefreshing = false
      throw err
    }
  }

  return res.json()
}
