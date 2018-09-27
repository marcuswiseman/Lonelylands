class Form {
	constructor(target, actionUrl, fields) {
		this.target = target;
		this.actionUrl = actionUrl;
		this.fields = fields;
	}

	change(val) {
		this.target = val;
	}

	response(val) {
		this.prev_target = this.target;
		this.target = 'response';

		if (typeof val.response !== "undefined" && typeof val.response.data !== "undefined" && val.response.data != null) {

			switch (val.response.data.action) {
				case 'redirect':
					window.location.replace(val.response.data.url);
					break;
				case 'msg':
					this.reply = val.response.data.msg;
					break;
				case 'back_to_login': {
					this.fields = {
						username: '',
						email: '',
						con_email: '',
						password: '',
						con_password: ''
					};
					this.reply = val.response.data.msg;
					this.prev_target = 'login';
					break;
				}
			}

		} else {
			this.reply = val.msg;
		}
	}

	submit(event, values) {
		var post_data = {};
		var missing = [];
		var action = null;
		if (typeof event.target.elements.action !== 'undefined') {
			action = event.target.elements.action.value;
			post_data['action'] = action;
			if (dev) console.log(action);
			if (typeof values !== 'undefined') {
				values.forEach(function (value) {
					if (typeof event.target.elements.namedItem(value).value !== 'undefined' && event.target.elements.namedItem(value).value != '') {
						post_data[value] = event.target.elements.namedItem(value).value;
					} else {
						missing.push(value);
					}
				});
				if (typeof missing !== 'undefined' && missing.length > 0) {
					return this.response({
						status: 'error',
						msg: 'Missing field: ' + missing[0]
					});
				} else {
					if (dev) console.log(post_data);
					app.$http.post(this.actionUrl, post_data).then(reply => {
						if (dev) console.log(reply);
						if (reply.status == 200) {
							return this.response({
								status: 'ok',
								msg: reply.body.msg,
								response: reply.body
							});
						} else {
							return this.response({
								status: 'error',
								msg: 'Something went wrong, please report this issue to the site admin if it presists.'
							});
						}
					});
				}
			} else {
				return this.response({
					status: 'error',
					msg: 'Missing submit values, please specifiy submission values.'
				});
			}
		}
		else {
			return this.response({
				status: 'error',
				msg: 'Missing action value, attach name:action and value:??? to submit button.'
			});
		}

	}
}