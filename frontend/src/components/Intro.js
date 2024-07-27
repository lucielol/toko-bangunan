import { Container, Row, Col, Button} from 'react-bootstrap';

const Intro = () => {
    return (
        <div className="intro">
        <Container className="text-white text-center d-flex justify-content-center align-items-center">
          <Row> 
            <Col>
              <div className="title">Bangun impian anda</div>
              <div className="title">Bersama kami!</div>
              <div className="introButton mt-3">
                <Button variant="light">Lihat Semua List</Button>
              </div>
            </Col>
          </Row>
        </Container>
      </div>
    )
}

export default Intro;