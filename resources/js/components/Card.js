import React, {Component} from 'react';

class Card extends Component {
    constructor(props,context) {
        super(props,context);
        this.handleChangeOrder = this.handleChangeOrder.bind(this);
        this.state = {
            order: 12
        };
        window.card_component = this;
    }

    handleChangeOrder(order) {
        var state = this.state;
        state.order = order;
        this.setState(state);
    }

    render() {
        return (
            <div className="container">
                <div className="row justify-content-center">
                    <div className="col-md-8">
                        <div className="card">
                            <div className="card-header">Example Component</div>

                            <div className="card-body">Order: {this.state.order}</div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

export default Card;
