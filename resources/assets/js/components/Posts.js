import React from 'react';
import {Link} from 'react-router';

class Posts extends React.Component {

    componentDidMount() {
        this.props.actionsPosts.getPosts();
    }


    render() {

        const {fetching, posts} = this.props.posts;

        let stringLimit = (str) => {
            if (str.length > 100)
                str = str.substring(0, 100) + "...";
            return str;
        }

        let imgStyle = {
            width: 100
        };


        let render = posts.map(post =>

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
                                        stringLimit(post.content)
                                    }
                                </p>
                                <div className="align-self-bottom">
                                    { post.created_at }
                                </div>
                            </div>
                        </div>
                    </div>
                    <div className="medium-3 columns" style={ imgStyle }>
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

        return (
            <div>
                {
                    !fetching && render
                }
            </div>
        )

    }
}

export default Posts
