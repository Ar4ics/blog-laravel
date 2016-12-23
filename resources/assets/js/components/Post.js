import React, {Component} from 'react';
import {Link} from 'react-router';


class Post extends Component {
    constructor(props) {
        super(props);

        this.containerStyle = {
            width: 90
        };
        this.imgStyle = {
            width: 50
        };

        this.labelStyle = {
            marginRight: 10
        }
        this.state = {
            post: {
                comments: [],
                tags: []
            }
        };
    }


    componentDidMount() {

        const slug = this.props.params.slug;

        fetch('/api/posts/' + slug)
            .then(response => {
                return response.json();
            })
            .then(post => {
                this.setState({post});
            });


    }

    renderComments() {
        return this.state.post.comments.map(comment => {
            return (
                <div className="column row" key={ comment.id }>
                    <div className="media-object">

                        <div className="media-object-section">
                            <div

                                className="card text-center"
                                style={ this.containerStyle }>
                                <img src={ comment.user.avatar } style={ this.imgStyle }/>

                                <p>{ comment.user.name }</p>

                            </div>
                        </div>
                        <div className="media-object-section text-justify">
                            <div>
                                <p>{ comment.comment }</p>
                                <span>{ comment.created_at }</span>
                            </div>
                        </div>
                    </div>
                </div>
            );
        });
    }

    renderTags() {
        return this.state.post.tags.map(tag => {
            return (
                <Link key={ tag.id } to={'/tags/' + tag.name} className="label success" style = { this.labelStyle }
                   >#{ tag.name }</Link>
            );
        })
    }

    render() {

        return (
            <div>
                <div className="column row">
                    <h3>
                        { this.state.post.title }
                    </h3>
                </div>
                <div className="column row">
                    <h5 className="text-justify">
                        { this.state.post.content }
                    </h5>
                </div>

                <div className="column row">
                    { this.renderTags() }
                </div>
                <div className="column row">
                    <br/>
                </div>
                { this.renderComments()}



            </div>
        );
    }

}

export default Post