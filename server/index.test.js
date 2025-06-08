const request = require('supertest');
const app = require('./index');

describe('GET /sessioninfo', () => {
  it('responds with 401 when no session cookie is present', async () => {
    const res = await request(app).get('/sessioninfo');
    expect(res.status).toBe(401);
  });
});
