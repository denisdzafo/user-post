import http from "./http-common";

class endPoints {
	register(data) {
	    return http.post("/auth/register", data);
	  }

	  login(data) {
	  	return http.post("/auth/login", data);
	  }

	  logOut() {
		return http.post("/auth/logout");
	}

	  getPosts(page) {
	    return http.get(`/posts?page=${page}`);
	  }

	  createPost(data) {
	    return http.post("/auth/post/create", data);
	  }

	  createComment(data) {
	    return http.post("/auth/comment/create", data);
	  }


	  singlePost(id) {
	    return http.get(`/post/single/${id}`);
	  }

	  editPost(data) {
	    return http.post("/auth/post/edit", data);
	  }

	  deletePost(id) {
	    return http.get(`/auth/post/delete/${id}`);
	  }


}

export default new endPoints();