import React, {Component} from 'react';
import {Link} from 'react-router';
import {bindActionCreators} from 'redux'
import {connect} from 'react-redux'
import * as postsActions from '../actions/PostsActions'
class Home extends Component {

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
                                            Home.stringLimit(post.content)
                                        }
                                    </p>
                                    <div className="align-self-bottom">
                                        { post.created_at }
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="medium-3 columns" style={ Home.imgStyle }>
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
        this.props.actionsPosts.getPosts();

    }

    render() {


        const {fetching, posts} = this.props;



        return (
            <div>
            {
                !fetching ?
                this.renderPosts(posts)
                :
                    ""
            }
            </div>
        );
    }
}


function mapStateToProps(state) {
    return {
        posts: state.posts.posts
    }
}

function mapDispatchToProps(dispatch) {
    return {
        actionsPosts: bindActionCreators(postsActions, dispatch)
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(Home)