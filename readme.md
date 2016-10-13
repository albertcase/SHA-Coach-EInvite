###模拟微信授权接口
**url:** /api/demonlogin

**Method:** GET

**param:** None

**feedbacks:**
	success

###提交接口
**url:** /api/submit

**Method:** POST

**param:**

	{
		callnumber: '123456'
	}

**feedbacks:**

	{
		code: '10',
		msg: '注册成功'
	}

	{
		code: '11',
		msg: '输入错误'
	}
	
    {
		code: '2',
		msg: '您还未登陆'
	}
	{
		code: '7',
		msg: '您已经超过注册次数'
	}
	{
		code: '6',
		msg: '您已经注册过'
	}
	{
		code: '9',
		msg: '号码不存在'
	}
	{
		code: '8',
		msg: '号码已经被注册'
	}
	{
		code: '5',
		msg: '请刷新页面'
	}
	{
		code: '4',
		msg: '注册错误'
	}