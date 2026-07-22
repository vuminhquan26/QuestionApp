import { setToken } from './storage'
import { http } from '../api/http'

export async function refreshToken() {
  const res = await http('/auth/refresh', {
    method: 'POST',
  })

  if (!res?.access_token) {
    throw new Error('Refresh token thất bại')
  }

  setToken(res.access_token)
  return res.access_token
}
