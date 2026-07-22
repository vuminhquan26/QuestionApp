import { http } from '../api/http'
import { setToken, removeToken } from './storage'

export async function login(email, password) {
  const res = await http('/auth/login', {
    method: 'POST',
    body: JSON.stringify({ email, password }),
  })

  if (!res?.access_token) {
    throw new Error('Không nhận được token')
  }

  setToken(res.access_token)

  const role = res?.data?.role?.name || res?.data?.role || res?.data?.roles?.[0]?.name

  if (!role) {
    throw new Error('Không xác định được role')
  }

  const normalizedRole = role.toLowerCase()
  localStorage.setItem('role', normalizedRole)

  return normalizedRole
}

export async function logout() {
  await http('/auth/logout', { method: 'POST' })
  removeToken()
  localStorage.removeItem('role')
}
