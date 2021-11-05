class pageHome {
	static init(){
		let arr = ['test', 'item', 'for', 'es6'];

		console.log( `You are on this [${location.pathname}] page.` );
		console.log( arr.map( item => item.includes('e') ) );
	}
}


jQuery(() => { pageHome.init(); });