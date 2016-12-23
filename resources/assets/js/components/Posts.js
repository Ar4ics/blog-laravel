import React, {Component} from 'react';
import {Link} from 'react-router';
export default class Posts extends Component {

    // componentDidMount() {
    //     if (this.props.params.tag) {
    //         fetch('/api/tags/' + this.props.params.tag)
    //             .then(response => {
    //                 return response.json();
    //             })
    //             .then(posts => {
    //                 store.dispatch({
    //                     type: 'POST_LIST_SUCCESS',
    //                     posts: posts
    //                 });
    //             });
    //     } else {
    //         fetch('/api/posts')
    //             .then(response => {
    //                 return response.json();
    //             })
    //             .then(posts => {
    //                 this.setState({posts});
    //             });
    //     }
    // }

    static
    stringLimit(str) {
        if (str.length > 100)
            str = str.substring(0, 100) + "...";
        return str;
    }

    static
    imgStyle = {
        width: 100
    };

    renderPosts(posts) {


        return posts.map(post => {
            return (
                <div key={ post.id }>
                    <div className="row">
                        <div className="medium-9 columns">
                            <div className="column row">
                                <div className="medium-12 columns">
                                    <Link
                                        to={"/posts/" + post.slug}>
                                        { post.title }
                                    </Link>
                                </div>
                            </div>
                            <div className="column row">
                                <div className="medium-12 columns">
                                    <p className="text-justify">
                                        {
                                            Posts.stringLimit(post.content)
                                        }
                                    </p>
                                    <div className="align-self-bottom">
                                        { post.created_at }
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="medium-3 columns" style={ Posts.imgStyle }>
                            <div className="text-center">
                                <img src={ post.user.avatar } alt="Avatar"/>
                                <span>{ post.user.name }</span>
                            </div>
                        </div>
                    </div>
                    <div className="column row">
                        <hr/>
                    </div>
                </div>

            );
        })
    }



    componentDidMount(){
        this.props.getPosts();
    }
    render() {


        const {fetching, posts} = this.props;
        console.log(posts);
        return (
            <div>
                {
                    !fetching ?
                        this.renderPosts(posts)

                        :
                        <p>нету</p>
                }
            </div>
        );
    }
}