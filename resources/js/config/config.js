// _env.js must be added manually, cause it's ignored by git
import _env from './_env'

const myConfig = {
	originURL: _env.url.ORIGIN,
	apiURL: _env.url.API,
};

export default myConfig
